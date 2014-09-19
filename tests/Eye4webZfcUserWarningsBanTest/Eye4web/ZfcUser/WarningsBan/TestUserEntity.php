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

namespace Eye4webZfcUserWarningsBanTest\Eye4web\ZfcUser\WarningsBan;

use Eye4web\ZfcUser\Ban\Entity\UserBannableInterface;
use ZfcUser\Entity\UserInterface;

class TestUserEntity implements UserInterface, UserBannableInterface
{
    /**
     * @return boolean
     */
    public function getIsBanned()
    {
        // TODO: Implement getIsBanned() method.
    }

    public function setIsBanned($banned)
    {
        // TODO: Implement setIsBanned() method.
    }

    /**
     * @return string
     */
    public function getBannedReason()
    {
        // TODO: Implement getBannedReason() method.
    }

    public function setBannedReason($reason)
    {
        // TODO: Implement setBannedReason() method.
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        // TODO: Implement getId() method.
    }

    /**
     * Set id.
     *
     * @param int $id
     * @return UserInterface
     */
    public function setId($id)
    {
        // TODO: Implement setId() method.
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        // TODO: Implement getUsername() method.
    }

    /**
     * Set username.
     *
     * @param string $username
     * @return UserInterface
     */
    public function setUsername($username)
    {
        // TODO: Implement setUsername() method.
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        // TODO: Implement getEmail() method.
    }

    /**
     * Set email.
     *
     * @param string $email
     * @return UserInterface
     */
    public function setEmail($email)
    {
        // TODO: Implement setEmail() method.
    }

    /**
     * Get displayName.
     *
     * @return string
     */
    public function getDisplayName()
    {
        // TODO: Implement getDisplayName() method.
    }

    /**
     * Set displayName.
     *
     * @param string $displayName
     * @return UserInterface
     */
    public function setDisplayName($displayName)
    {
        // TODO: Implement setDisplayName() method.
    }

    /**
     * Get password.
     *
     * @return string password
     */
    public function getPassword()
    {
        // TODO: Implement getPassword() method.
    }

    /**
     * Set password.
     *
     * @param string $password
     * @return UserInterface
     */
    public function setPassword($password)
    {
        // TODO: Implement setPassword() method.
    }

    /**
     * Get state.
     *
     * @return int
     */
    public function getState()
    {
        // TODO: Implement getState() method.
    }

    /**
     * Set state.
     *
     * @param int $state
     * @return UserInterface
     */
    public function setState($state)
    {
        // TODO: Implement setState() method.
    }

}
