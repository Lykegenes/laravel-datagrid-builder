<?php namespace Lykegenes\LaravelDatagridBuilder;

use Kris\LaravelFormBuilder\Datagrid;
use Kris\LaravelFormBuilder\FormHelper;

/**
 * Class FormField
 *
 * @package Kris\LaravelFormBuilder\Fields
 */
class DatagridColumn
{

	/**
	 * Name of the column
	 *
	 * @var
	 */
	protected $name;

	/**
	 * All options for the column
	 *
	 * @var
	 */
	protected $options = [];

	/**
	 * Is column rendered
	 *
	 * @var bool
	 */
	protected $rendered = false;

	/**
	 * @var Datagrid
	 */
	protected $parent;

	/**
	 * @var string
	 */
	protected $template;

	/**
	 * @var FormHelper
	 */
	protected $datagridHelper;

	/**
	 * @param             $name
	 * @param             $type
	 * @param Datagrid    $parent
	 * @param array       $options
	 */
	public function __construct($name, Datagrid $parent, array $options = [])
	{
		$this->name = $name;
		$this->parent = $parent;
		$this->datagridHelper = $this->parent->getFormHelper();
		$this->setDefaultOptions($options);
	}

	/**
	 * @param array $options
	 * @param bool  $showColumn
	 * @return string
	 */
	public function render(array $options = [], $showColumn = true)
	{
		if ($showColumn)
		{
			$this->rendered = true;
		}

		return $this->datagridHelper->getView()->make(
			$this->template,
			[
				'name' => $this->name,
				'nameKey' => $this->getNameKey(),
				'label' => $this->datagridHelper->formatLabel($this->getRealName()),
				'options' => $options,
				'showColumn' => $showColumn,
			]
		)->render();
	}

	protected function getTemplate()
	{
		return 'static';
	}

	/**
	 * Transform array like syntax to dot syntax
	 *
	 * @param $key
	 * @return mixed
	 */
	protected function transformKey($key)
	{
		return str_replace(['.', '[]', '[', ']'], ['_', '', '.', ''], $key);
	}

	/**
	 * Prepare options for rendering
	 *
	 * @param array $options
	 * @return array
	 */
	protected function prepareOptions(array $options = [])
	{
		$helper = $this->datagridHelper;

		$options = $helper->mergeOptions($this->options, $options);

		$options['colAttrs'] = $helper->prepareAttributes($options['attr']);

		$options['colSettings'] = $helper->prepareAttributes([
				'data-column-id' => $this->name,
				'data-type' => $options['type'],
				'data-formatter' => $options['formatter'],
				'data-sortable' => $options['sortable'],
				'data-searchable' => $options['searchable'],
			]);

		return $options;
	}

	/**
	 * Get name of the column
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Set name of the column
	 *
	 * @param string $name
	 * @return $this
	 */
	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	/**
	 * Get dot notation key for columns
	 *
	 * @return string
	 **/
	public function getNameKey()
	{
		return $this->transformKey($this->name);
	}

	/**
	 * Get column options
	 *
	 * @return array
	 */
	public function getOptions()
	{
		return $this->options;
	}

	/**
	 * Get single option from options array. Can be used with dot notation ('attr.class')
	 *
	 * @param        $option
	 * @param string $default
	 *
	 * @return mixed
	 */
	public function getOption($option, $default = null)
	{
		return array_get($this->options, $option, $default);
	}

	/**
	 * Set column options
	 *
	 * @param array $options
	 * @return $this
	 */
	public function setOptions($options)
	{
		$this->options = $this->prepareOptions($options);

		return $this;
	}

	/**
	 * Set single option on the column
	 *
	 * @param string $name
	 * @param mixed $value
	 * @return $this
	 */
	public function setOption($name, $value)
	{
		array_set($this->options, $name, $value);

		return $this;
	}

	/**
	 * @return Datagrid
	 */
	public function getParent()
	{
		return $this->parent;
	}

	/**
	 * Check if the column is rendered
	 *
	 * @return bool
	 */
	public function isRendered()
	{
		return $this->rendered;
	}

	/**
	 * Default options for field
	 *
	 * @return array
	 */
	protected function getDefaults()
	{
		return [];
	}

	/**
	 * Defaults used across all columns
	 *
	 * @return array
	 */
	private function allDefaults()
	{
		return [
			'label' => $this->datagridHelper->formatLabel($this->getRealName()),
			'sortable' => null,
			'searchable' => null,
			'formatter' => null,
			'type' => null,
			'attr' => ['class' => $this->datagridHelper->getConfig('defaults.field_class')],
		];

		return [
			'wrapper' => ['class' => $this->datagridHelper->getConfig('defaults.wrapper_class')],
			'attr' => ['class' => $this->datagridHelper->getConfig('defaults.field_class')],
			'help_block' => ['text' => null, 'tag' => 'p', 'attr' => [
				'class' => $this->datagridHelper->getConfig('defaults.help_block_class'),
			]],
			'value' => null,
			'default_value' => null,
			'label' => $this->datagridHelper->formatLabel($this->getRealName()),
			'is_child' => false,
			'label_attr' => ['class' => $this->datagridHelper->getConfig('defaults.label_class')],
			'errors' => ['class' => $this->datagridHelper->getConfig('defaults.error_class')],
		];
	}

	/**
	 * Get real name of the column without form namespace
	 *
	 * @return string
	 */
	public function getRealName()
	{
		return $this->getOption('real_name', $this->name);
	}

	/**
	 * Merge all defaults with column specific defaults and set template if passed
	 *
	 * @param array $options
	 */
	protected function setDefaultOptions(array $options = [])
	{
		$this->options = $this->datagridHelper->mergeOptions($this->allDefaults(), $this->getDefaults());
		$this->options = $this->prepareOptions($options);
	}
}