<?php
/**
 * class-karma-database.php
 *
 * Copyright (c) 2011,2012 Antonio Blanco http://www.blancoleon.com
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
 *
 */

class Karma_Database {
	
	public static $prefix = "karma_";
	 
	public static function karma_get_table( $table ) {
		global $wpdb;
		$result = "";
		switch ( $table ) {
			case "users":
				$result = $wpdb->prefix . self::$prefix . "users";
				break;
		}
		return $result;
	}
	
	public static function getKarmaUser ( $user_id ) {
		global $wpdb;
	
		$result = $wpdb->get_row("SELECT karma FROM " . self::karma_get_table( "users" ) . " WHERE user_id = '$user_id'");
	
		if ( $result ) {
			$result = $result->karma;
		} else {
			$result = 0;
		}
		return $result;
	}
	
	public static function getKarmaUsers ( $limit, $order_by, $order ){
		global $wpdb;
		
		$result = $wpdb->get_results("SELECT * FROM " . self::karma_get_table( "users" ) . " ORDER BY " . $order_by . " " . $order . " LIMIT 0 ," . $limit);
		
		return $result;
	}
	
	public static function updateKarmaUser( $karma, $user_id ) {
		global $wpdb;
	
		$rows_affected = $wpdb->update( self::karma_get_table("users"), array( 'karma' => $karma ) , array( 'user_id' => $user_id ) );
	
		if ( !$rows_affected ) { // insert
			$rows_affected = $wpdb->insert( self::karma_get_table("users"), array( 'user_id' => $user_id, 'karma' => $karma ) );
		}
		return $rows_affected;
	}
	
}


