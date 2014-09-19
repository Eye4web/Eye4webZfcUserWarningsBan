<?php

namespace Eye4webZfcUserWarningsBanTest\Eye4web\ZfcUser\WarningsBan;

use Zend\Mvc\MvcEvent;
use Eye4web\ZfcUser\WarningsBan\Module;

class ModuleTest extends \PHPUnit_Framework_TestCase
{
    protected $module;

    public function setUp()
    {
        $this->module = new Module();
    }

    public function testOnBootstrap()
    {
        $application = $this->getMockBuilder('Zend\Mvc\Application')
            ->disableOriginalConstructor()
            ->getMock();

        $mvcEvent = $this->getMock('Zend\Mvc\MvcEvent');
        $mvcEvent->expects($this->once())
            ->method('getApplication')
            ->will($this->returnValue($application));

        $eventManager = $this->getMock('Zend\EventManager\EventManagerInterface');
        $sharedEventManager = $this->getMock('Zend\EventManager\EventManagerInterface');

        $eventManager->expects($this->once())
            ->method('getSharedManager')
            ->will($this->returnValue($sharedEventManager));
        $application->expects($this->once())
            ->method('getEventManager')
            ->will($this->returnValue($eventManager));

        $sharedEventManager->expects($this->once())
            ->method('attach')
            ->with('Eye4web\ZfcUser\Warnings\Service\WarningsService', 'addWarning.post', array($this->module, 'checkForBan'));

        $this->module->onBootstrap($mvcEvent);

        $this->module->setApplication($application);
        $this->module->getApplication();
    }

    /**
     * @dataProvider checkBanDataProvider
     */
    public function testCheckForBan($configWarningsForBan, $userWarningsCount, $configWeightsForBan, $userWeightCount)
    {
        $userWarningsArray = [];
        for ($i = 1; $i <= $userWarningsCount; $i++) {
            $warning = $this->getMock('Eye4web\ZfcUser\Warnings\Entity\WarningInterface');
            $warning->expects($this->any())
                ->method('getWeight')
                ->will($this->returnValue($userWeightCount/$userWarningsCount));
            $userWarningsArray[] = $warning;
        }

        $warningsService = $this->getMockBuilder('Eye4web\ZfcUser\Warnings\Service\WarningsService')
            ->disableOriginalConstructor()
            ->getMock();

        $userMapper = $this->getMockBuilder('ZfcUser\Mapper\UserInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $moduleOptions = $this->getMockBuilder('Eye4web\ZfcUser\WarningsBan\Options\ModuleOptionsInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $serviceManager = $this->getMockBuilder('Zend\ServiceManager\ServiceLocatorInterface')
            ->disableOriginalConstructor()
            ->getMock();
        $serviceManager->expects($this->at(0))
            ->method('get')
            ->with('Eye4web\ZfcUser\Warnings\Service\WarningsService')
            ->will($this->returnValue($warningsService));
        $serviceManager->expects($this->at(1))
            ->method('get')
            ->with('zfcuser_user_mapper')
            ->will($this->returnValue($userMapper));
        $serviceManager->expects($this->at(2))
            ->method('get')
            ->with('Eye4web\ZfcUser\WarningsBan\Options\ModuleOptions')
            ->will($this->returnValue($moduleOptions));

        $application = $this->getMockBuilder('Zend\Mvc\Application')
            ->disableOriginalConstructor()
            ->getMock();
        $application->expects($this->once())
            ->method('getServiceManager')
            ->will($this->returnValue($serviceManager));

        $this->module->setApplication($application);

        $event = $this->getMock('Zend\EventManager\Event');

        $warning = $this->getMock('Eye4web\ZfcUser\Warnings\Entity\WarningInterface');
        $event->expects($this->once())
            ->method('getParam')
            ->with('warning')
            ->will($this->returnValue($warning));

        $moduleOptions->expects($this->any())
            ->method('getWarningsForBan')
            ->will($this->returnValue($configWarningsForBan));

        $userId = 1;
        $user = $this->getMock('Eye4webZfcUserWarningsBanTest\Eye4web\ZfcUser\WarningsBan\TestUserEntity');

        if ($configWarningsForBan) {
            $warning->expects($this->any())
                ->method('getUser')
                ->will($this->returnValue($userId));

            $userMapper->expects($this->any())
                ->method('findById')
                ->with($userId)
                ->will($this->returnValue($user));

            $warningsService->expects($this->any())
                ->method('getUserWarnings')
                ->with($user)
                ->will($this->returnValue($userWarningsArray));

            $reasonWarningsForBan = 'you are banned for warnings';

            if ($configWarningsForBan && count($userWarningsArray) >= $configWarningsForBan) {
                $user->expects($this->once())
                    ->method('setIsBanned')
                    ->with(true);
                $user->expects($this->once())
                    ->method('setBannedReason')
                    ->with($reasonWarningsForBan);
                $moduleOptions->expects($this->once())
                    ->method('getWarningsBanReason')
                    ->will($this->returnValue($reasonWarningsForBan));

                $userMapper->expects($this->once())
                    ->method('update')
                    ->with($user);

                $moduleOptions->expects($this->never())
                    ->method('getWeightForban');
            }

        }

        if ((!$configWarningsForBan || count($userWarningsArray) < $configWarningsForBan) && $configWeightsForBan) {
            $warning->expects($this->any())
                ->method('getUser')
                ->will($this->returnValue($userId));

            $userMapper->expects($this->any())
                ->method('findById')
                ->with($userId)
                ->will($this->returnValue($user));

            $warningsService->expects($this->any())
                ->method('getUserWarnings')
                ->with($user)
                ->will($this->returnValue($userWarningsArray));

            $moduleOptions->expects($this->exactly(2))
                ->method('getWeightForBan')
                ->will($this->returnValue($configWeightsForBan));

            $reasonWeightForBan = 'you are banned for warnings';

            if ($configWeightsForBan && $userWeightCount >= $configWeightsForBan) {
                $user->expects($this->once())
                    ->method('setIsBanned')
                    ->with(true);
                $user->expects($this->once())
                    ->method('setBannedReason')
                    ->with($reasonWeightForBan);
                $moduleOptions->expects($this->once())
                    ->method('getWeightBanReason')
                    ->will($this->returnValue($reasonWeightForBan));

                $userMapper->expects($this->once())
                    ->method('update')
                    ->with($user);
            }
        }

        $this->module->checkForBan($event);
    }

    public function testGetConfig()
    {
        $result = $this->module->getConfig();
        $this->assertTrue(is_array($result));
    }

    public function checkBanDataProvider()
    {
        //  $configWarningsForBan, $userWarningsCount, $configWeightsForBan, $userWeightCount
        return [
            [false, 3, false, 5],
            [2, 3, false, 5],
            [3, 3, false, 5],
            [5, 3, false, 5],
            [2, 3, 2, 5],
            [2, 3, 5, 5],
            [2, 3, 7, 5],
            [3, 3, 5, 5],
            [3, 3, 2, 5],
            [3, 3, 5, 5],
            [5, 3, 2, 5],
            [5, 3, 5, 5],
            [5, 3, 7, 5],
            [false, 3, 2, 5],
            [false, 3, 2, 5],
            [false, 3, 7, 5],
        ];
    }
}
