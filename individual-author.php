<?php
/*
  Plugin Name: Individual Multisite Author
  Version: 1.0
  Plugin URI: http://webgilde.com/
  Description: Allow individual author information for each blog in a multisite network.
  Author: Thomas Maier
  Author URI: http://www.webgilde.com/
  License: GPL v2 or later

  adblock-counter Plugin for WordPress
  Copyright (C) 2013, webgilde GmbH, Thomas Maier (thomas.maier@webgilde.com)

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
if (!function_exists('add_action')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

define('IMAVERSION', '1.0');
define('IMADIR', basename(dirname(__FILE__)));
define('IMAPATH', plugin_dir_path(__FILE__));

// load the plugin only on multisites
if (is_multisite() && !class_exists('Ima_Class')) {

    class Ima_Class {

        /**
         * initialize the plugin
         * @since 1.0
         */
        public function __construct()
        {
            add_action('show_user_profile', array($this, 'add_custom_profile_fields'));
            add_action('edit_user_profile', array($this, 'add_custom_profile_fields'));

            add_action('personal_options_update', array($this, 'save_custom_profile_fields'));
            add_action('edit_user_profile_update', array($this, 'save_custom_profile_fields'));

            add_filter('get_the_author_description', array($this, 'get_author_description'), 10, 2);

            $this->field_name = 'ima_description_' . get_current_blog_id();
        }

        /**
         * construct the form fields for the author descriptions
         * @since 1.0
         * @param array $user user data
         */
        public function add_custom_profile_fields($user) {
            ?>
            <h3><?php _e('Site specific author information', 'ima'); ?></h3>
            <table class="form-table">
                <tr>
                    <th><label for="ima_description"><?php _e('Site specific biography', 'ima'); ?></label></th>
                    <td>
                        <textarea name="<?php echo $this->field_name; ?>" id="ima_description"><?php echo esc_attr(get_the_author_meta($this->field_name, $user->ID)); ?></textarea>
                        <br/><span class="description"><?php printf(__('Biography for %s', 'ima'), home_url()); ?></span>
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
        public function save_custom_profile_fields($user_id)
        {

            if (!current_user_can('edit_user', $user_id))
                return FALSE;

            if (isset($_POST[ $this->field_name ]))
                update_usermeta($user_id, $this->field_name, $_POST[$this->field_name]);
        }

        /**
         * get the new author description
         */
        public function get_author_description($val = '', $user_id = 0)
        {
            if ( intval( $user_id ) == 0) return;
            return esc_attr(get_the_author_meta($this->field_name, $user_id));
        }

    }

    $ima = new Ima_Class();
}
