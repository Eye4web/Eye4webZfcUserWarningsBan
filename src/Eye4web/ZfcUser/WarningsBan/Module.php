<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace Eye4web\ZfcUser\WarningsBan;

use Zend\EventManager\Event;
use Zend\Mvc\MvcEvent;

class Module
{
    protected $application;

    public function onBootstrap(MvcEvent $e)
    {
        $this->application = $e->getApplication();

        $eventManager = $this->application->getEventManager()->getSharedManager();
        $eventManager->attach('Eye4web\ZfcUser\Warnings\Service\WarningsService', 'addWarning.post', array($this, 'checkForBan'));
    }

    public function checkForBan(Event $e)
    {
        $application = $this->application;
        $serviceLocator = $application->getServiceManager();
        $warningsService = $serviceLocator->get('Eye4web\ZfcUser\Warnings\Service\WarningsService');
        $userMapper = $serviceLocator->get('zfcuser_user_mapper');
        $warningsBanConfig = $serviceLocator->get('Eye4web\ZfcUser\WarningsBan\Options\ModuleOptions');

        $warning = $e->getParam('warning');

        if ($warningsBanConfig->getWarningsForBan()) {
            $user = $userMapper->findById($warning->getUser());
            $warnings = $warningsService->getUserWarnings($user);
            if (count($warnings) >= $warningsBanConfig->getWarningsForBan()) {
                $user->setIsBanned(true);
                $user->setBannedReason($warningsBanConfig->getWarningsBanReason());
                $userMapper->update($user);
                return;
            }
        }

        if ($warningsBanConfig->getWeightForBan()) {
            $user = $userMapper->findById($warning->getUser());
            $warnings = $warningsService->getUserWarnings($user);
            $totalWeight = 0;
            foreach ($warnings as $warning) {
                $totalWeight += $warning->getWeight();
            }

            if ($totalWeight >= $warningsBanConfig->getWeightForBan()) {
                $user->setIsBanned(true);
                $user->setBannedReason($warningsBanConfig->getWeightBanReason());
                $userMapper->update($user);
            }
            return;
        }
    }

    public function getConfig()
    {
        return include __DIR__ . '/../../../../config/module.config.php';
    }

    /**
     * @return mixed
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * @param mixed $application
     */
    public function setApplication($application)
    {
        $this->application = $application;
    }
}
