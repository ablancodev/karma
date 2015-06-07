<?php
/**
 * class-karma.php
 *
 * Copyright (c) Antonio Blanco http://www.blancoleon.com
 *
 * This code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This header and all notices must be kept intact.
 *
 * @author Antonio Blanco
 * @package karma
 * @since karma 1.0.0
 */

/**
 * Karma class
 */
class Karma {

	public static function getKarma ( $user_id ) {
		return Karma_Database::getKarmaUser($user_id);
	}
	
	public static function setKarma ( $karma, $user_id ) {
		return Karma_Database::updateKarmaUser($karma, $user_id);
	}

	public static function getKarmaUsers ( $limit, $order_by, $order ) {
		return Karma_Database::getKarmaUsers ( $limit, $order_by, $order );
	}
	
}
