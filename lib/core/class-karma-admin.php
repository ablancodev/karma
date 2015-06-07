<?php
/**
 * class-karma-admin.php
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
 * @package wp-karma
 * @since wp-karma 1.0.0
 */

/**
 * Karma class
 */
class Karma_Admin {

	public static function init () {
		add_action( 'admin_notices', array( __CLASS__, 'admin_notices' ) );
		
		add_action( 'admin_menu', array( __CLASS__, 'admin_menu' ), 40 );
	}
	
	
	public static function admin_notices() {
		if ( !empty( self::$notices ) ) {
			foreach ( self::$notices as $notice ) {
				echo $notice;
			}
		}
	}
	
	/**
	 * Adds the admin section.
	 */
	public static function admin_menu() {
		$admin_page = add_menu_page(
				__( 'Karma' ),
				__( 'Karma' ),
				'manage_options',
				'karma',
				array( __CLASS__, 'karma_menu'),
				KARMA_PLUGIN_URL . '/img/logo.png'
		);
	
	}
	
	/**
	 * Show Karma setting page.
	 */
	public static function karma_menu () {
		$alert = "";
		if ( isset( $_POST['submit'] ) ) {
			add_option( 'karma-comments_enable', $_POST['karma_comments_enable'] ); 
			update_option( 'karma-comments_enable', $_POST['karma_comments_enable'] );
			
			add_option( 'karma-comments', $_POST['karma_comments'] );
			update_option( 'karma-comments', $_POST['karma_comments'] );
				
			add_option( 'karma-welcome', $_POST['karma_welcome'] );
			update_option( 'karma-welcome', $_POST['karma_welcome'] );

			$label = ( isset( $_POST['karma_label'] ) && $_POST['karma_label'] !== "" )?$_POST['karma_label']:"";
			add_option( 'karma-karma_label', $label );
			update_option( 'karma-karma_label', $label );
				
			$alert="Saved";
		}
		
		if ($alert != "") {
			echo '<div style="background-color: #ffffe0;border: 1px solid #993;padding: 1em;margin-right: 1em;">' . $alert . '</div>';
		}
		?>
			<h2><?php echo __( 'Karma Options', KARMA_DOMAIN ); ?></h2>
			<hr>
			
			<form method="post" action="">
			
				<div class="wrap" style="border: 1px solid #ccc; padding:10px;">
					<h3><?php echo __( 'General', KARMA_DOMAIN ); ?></h3>
					<div class="karma-admin-line">
						<div class="karma-admin-label">
							Karma label
						</div>
						<div class="karma-admin-value">
							<?php 
							$label = get_option('karma-karma_label', 'karmas');
							?>
							<input type="textbox" name="karma_label" value="<?php echo $label; ?>">
						</div>
					</div>
				</div>
				
				<div class="wrap" style="border: 1px solid #ccc; padding:10px;">
					<h3><?php echo __( 'Comments', KARMA_DOMAIN ); ?></h3>
					<div class="karma-admin-line">
						<div class="karma-admin-label">
							Enable comments karma
						</div>
						<div class="karma-admin-label">
							<?php 
							$enable_comments = get_option('karma-comments_enable', 1);
							?>
							<input type="checkbox" name="karma_comments_enable" value="1" <?php echo $enable_comments=="1"?" checked ":""?>>
						</div>
					</div>
					<div class="karma-admin-line">
						<div class="karma-admin-label">
							Comments karma
						</div>
						<div class="karma-admin-label">
							<?php 
							$enable_comments = get_option('karma-comments_enable', 1);
							?>
							<input type="textbox" name="karma_comments" value="<?php echo get_option('karma-comments', 1); ?>" size="4">
						</div>
					</div>
				</div>
		
				<div class="wrap" style="border: 1px solid #ccc; padding:10px;">
					<h3><?php echo __( 'Others', KARMA_DOMAIN ); ?></h3>
					<div class="karma-admin-line">
						<div class="karma-admin-label">
							Welcome karma
						</div>
						<div class="karma-admin-label">
							<input type="textbox" name="karma_welcome" value="<?php echo get_option('karma-welcome', "0"); ?>" size="4">
						</div>
					</div>
				</div>
				
				<div class="karma-admin-line">
					<?php submit_button("Save"); ?>
				</div>
				
		    	<?php settings_fields( 'karma-settings' ); ?>
				
		    </form>
			
		<?php 
	}
	
}