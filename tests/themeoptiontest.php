<?php
/**
 * Class SampleTest
 *
 * @package Nicageek_Blogtheme
 */
require_once dirname(__DIR__).'/vendor/autoload.php';
require_once ABSPATH.'wp-includes/class-wp-customize-manager.php';
/**
 * Theme Option Test.
 */

use Nicageek\Blogtheme\Classes\Options\Theme_Media_Option as ThOption;


class ThemeOptionTest extends WP_UnitTestCase {



	public function test_register_option() {
		// Replace this with some actual testing code.
		$wp_customize = new WP_Customize_Manager();
		$option_args = [
			'option_name' => 'myoption',
			'option_current_value' => 'it worked',
			'option_type' => 'text',
			'option_title' => 'My option',
			'option_description' => '',
			'option_section' => 'My option',
			'option_possible_values' => [
				'1' => 'Option 1',
				'2' => 'Option 2',
			 ],
		];
		$test_options = new ThOption($option_args);
		$this->assertInstanceOf(ThOption::class,$test_options);
		$this->assertIsArray($test_options->option_possible_values);
		$this->assertSame($test_options->option_name,'myoption');
		$test_options->Register_Option($wp_customize);
		$this->assertSame($test_options->get_value(),'it worked');
		$test_options->set_value('it worked2');
		$this->assertSame($test_options->get_value('it worked2'),'it worked2');
	}
}