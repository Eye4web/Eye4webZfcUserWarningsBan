<?php

/**
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

namespace Eye4web\ZfcUser\WarningsBan\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions implements ModuleOptionsInterface
{
    /**
     * @var integer|false
     * How many warnings should the user get before being banned
     * Set to false for disabled
     * Default: false
     */
    protected $warningsForBan = false;

    /**
     * @var integer|false
     * How much warnings weight should the user get before being banned
     * Set to false for disabled
     * Default: false
     */
    protected $weightForBan = false;

    /** @var string  */
    protected $WarningsbanReason = 'You\'ve been ban for having to much warnings';

    /** @var string  */
    protected $WeightbanReason = 'You\'ve been ban for having to much warnings weight';

    /**
     * @return int
     */
    public function getWarningsForBan()
    {
        return $this->warningsForBan;
    }

    /**
     * @param int $warningsForBan
     */
    public function setWarningsForBan($warningsForBan)
    {
        $this->warningsForBan = $warningsForBan;
    }

    /**
     * @return int
     */
    public function getWeightForBan()
    {
        return $this->weightForBan;
    }

    /**
     * @param int $weightForBan
     */
    public function setWeightForBan($weightForBan)
    {
        $this->weightForBan = $weightForBan;
    }

    /**
     * @return string
     */
    public function getWarningsbanReason()
    {
        return $this->WarningsbanReason;
    }

    /**
     * @param string $WarningsbanReason
     */
    public function setWarningsbanReason($WarningsbanReason)
    {
        $this->WarningsbanReason = $WarningsbanReason;
    }

    /**
     * @return string
     */
    public function getWeightbanReason()
    {
        return $this->WeightbanReason;
    }

    /**
     * @param string $WeightbanReason
     */
    public function setWeightbanReason($WeightbanReason)
    {
        $this->WeightbanReason = $WeightbanReason;
    }



}
