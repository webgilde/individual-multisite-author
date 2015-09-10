<?php
/**
 * Plugin Name: Individual Multisite Author
 * Description: Use individual author descriptions for each site on WordPress multisites
 * Version: 1.2.5
 * Plugin URI: http://webgilde.com/
 * Author: Thomas Maier
 * Author URI: http://webgilde.com/
 * License: GPL v2 or later
 *

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
//avoid direct calls to this file
if ( ! function_exists( 'is_multisite' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

define( 'IMAVERSION', '1.2.5' );
define( 'IMADIR', basename( dirname( __FILE__ ) ) );
define( 'IMAPATH', plugin_dir_path( __FILE__ ) );

// load the plugin only on multisites
if ( ! class_exists( 'Ima_Class', false ) && is_multisite() ) {

	class Ima_Class {

		/**
		 * initialize the plugin
		 * @since 1.0
		 */
		public function __construct() {
			// Load plugin text domain
			add_action( 'plugins_loaded', array( $this, 'load_plugin_textdomain' ) );

			add_action( 'show_user_profile', array( $this, 'add_custom_profile_fields' ) );
			add_action( 'edit_user_profile', array( $this, 'add_custom_profile_fields' ) );

			add_action( 'personal_options_update', array( $this, 'save_custom_profile_fields' ) );
			add_action( 'edit_user_profile_update', array( $this, 'save_custom_profile_fields' ) );

			add_filter( 'get_the_author_description', array( $this, 'get_author_description' ), 10, 2 );

			$this->field_name = 'ima_description_' . get_current_blog_id();
		}

		/**
		 * Load the plugin text domain for translation.
		 *
		 * @since    1.2.0
		 */
		public function load_plugin_textdomain() {

			load_plugin_textdomain( 'ima', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}

		/**
		 * construct the form fields for the author descriptions
		 * @since 1.0
		 * @param array $user user data
		 */
		public function add_custom_profile_fields($user) {
			?>
            <h3><?php _e( 'Site specific author information', 'ima' ); ?></h3>
            <table class="form-table">
                <tr>
                    <th><label for="ima_description"><?php _e( 'Site specific biography', 'ima' ); ?></label></th>
                    <td>
                        <textarea cols="30" rows="5" name="<?php echo esc_attr( $this->field_name ); ?>" id="ima_description"><?php echo esc_attr( get_the_author_meta( $this->field_name, $user->ID ) ); ?></textarea>
                        <br/><span class="description"><?php printf( __( 'Biography for %s', 'ima' ), home_url() ); ?></span>
                    </td>
                </tr>
            </table>
            <?php
		}

		/**
		 * update the user descriptions
		 * @since 1.0
		 * @param int $user_id
		 * @return boolean
		 */
		public function save_custom_profile_fields($user_id) {

			if ( ! current_user_can( 'edit_user', $user_id ) ) {
				return false; }

			if ( isset($_POST[ $this->field_name ]) ) { // input var okay
				update_user_meta( $user_id, $this->field_name, $_POST[ $this->field_name ] ); // input var okay
			}
		}

		/**
		 * get the new author description
		 * @return string $description individual author description, if provided
		 * @return string $val normal WordPress author bio if indiv. description is empty
		 * @since 1.0
		 * @updated 1.2.1
		 */
		public function get_author_description($val = '', $user_id = 0) {
			if ( ! $user_id ) {
				return;
			}
			$description = get_the_author_meta( $this->field_name, $user_id );

			return '' == $description ? $val : $description;
		}

	}

	new Ima_Class();
}
