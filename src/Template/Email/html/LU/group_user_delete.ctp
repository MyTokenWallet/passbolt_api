<?php
/**
 * Passbolt ~ Open source password manager for teams
 * Copyright (c) Passbolt SARL (https://www.passbolt.com)
 *
 * Licensed under GNU Affero General Public License version 3 of the or any later version.
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Passbolt SARL (https://www.passbolt.com)
 * @license       https://opensource.org/licenses/AGPL-3.0 AGPL License
 * @link          https://www.passbolt.com Passbolt(tm)
 * @since         2.0.0
 */
use App\Utility\Purifier;
use Cake\I18n\FrozenTime;
use Cake\Routing\Router;

$admin = $body['admin'];
$group = $body['group'];

echo $this->element('email/module/avatar',[
    'url' => Router::url($admin->profile->avatar->url['small'], true),
    'text' => $this->element('email/module/avatar_text', [
        'username' => Purifier::clean($admin->username),
        'first_name' => Purifier::clean($admin->profile->first_name),
        'last_name' => Purifier::clean($admin->profile->last_name),
        'datetime' => FrozenTime::now(),
        'text' => __('{0} removed you from the group {1}', null, Purifier::clean($group->name))
    ])
]);

$text = __('You are no longer a member of this group.');
$text .= ' ' . __('You are no longer authorized to access the passwords shared with this group.');
$text .= ' ' . __('Please contact {0} or another group manager if this is a mistake.',
    Purifier::clean($admin->profile->first_name)
);

echo $this->element('email/module/text', [
    'text' => $text
]);

echo $this->element('email/module/button', [
    'url' => Router::url('/'),
    'text' => __('log in passbolt')
]);