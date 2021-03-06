<?php
/**
 * Abstract breadcrumb item locator class.
 * 
 * Used as a base for all breadcrumb locator types.
 */
abstract class Carbon_Breadcrumb_Locator {

	/**
	 * Breadcrumb item locator type.
	 *
	 * @access protected
	 * @var string
	 */
	protected $type = '';

	/**
	 * Breadcrumb item locator subtype.
	 *
	 * @access protected
	 * @var string
	 */
	protected $subtype = '';

	/**
	 * Build a new breadcrumb item locator of the selected type.
	 *
	 * @static
	 * @access public
	 *
	 * @param string $type Type of the breadcrumb item locator.
	 * @param string $subtype Subtype of the breadcrumb item locator.
	 * @return Carbon_Breadcrumb_Locator $locator The new breadcrumb item locator.
	 */
	public static function factory( $type, $subtype = '' ) {
		$type = str_replace( ' ', '', ucwords( str_replace( '_', ' ', $type ) ) );
		$class = 'Carbon_Breadcrumb_Locator_' . $type;

		if ( ! class_exists( $class ) ) {
			throw new Carbon_Breadcrumb_Exception( 'Unexisting breadcrumb locator type: "' . $type . '".' );
		}

		$locator = new $class( $type, $subtype );

		return $locator;
	}

	/**
	 * Constructor.
	 *
	 * Creates and configures a new breadcrumb item locator with the provided settings.
	 *
	 * @access public
	 *
	 * @param string $type Type of the breadcrumb item locator.
	 * @param string $subtype Subtype of the breadcrumb item locator.
	 */
	public function __construct( $type, $subtype ) {
		$this->set_type( $type );
		$this->set_subtype( $subtype );
	}

	/**
	 * Retrieve the type of this locator.
	 *
	 * @access public
	 *
	 * @return string $type The type of this locator.
	 */
	public function get_type() {
		return $this->type;
	}

	/**
	 * Modify the type of this locator.
	 *
	 * @access public
	 *
	 * @param string $type The new locator type.
	 */
	public function set_type( $type ) {
		$this->type = $type;
	}

	/**
	 * Retrieve the subtype of this locator.
	 *
	 * @access public
	 *
	 * @return string $subtype The subtype of this locator.
	 */
	public function get_subtype() {
		return $this->subtype;
	}

	/**
	 * Modify the subtype of this locator.
	 *
	 * @access public
	 *
	 * @param string $subtype The new locator subtype.
	 */
	public function set_subtype( $subtype ) {
		$this->subtype = $subtype;
	}

	/**
	 * Whether this the items of this locator should be included in the trail.
	 *
	 * @abstract
	 * @access public
	 */
	abstract public function is_included();
	
	/**
	 * Get the breadcrumb items, found by this locator.
	 *
	 * @abstract
	 * @access public
	 */
	abstract public function get_items();

	/**
	 * Generate a set of breadcrumb items that found by this locator type and any subtype.
	 *
	 * @abstract
	 * @access public
	 */
	abstract public function generate_items();
	
}