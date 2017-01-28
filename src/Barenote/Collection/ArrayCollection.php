<?php
namespace Barenote\Collection;

use ArrayIterator;
use Closure;

/**
 * Class ArrayCollection
 * @package Barenote\Collection
 */
class ArrayCollection implements \Countable, \IteratorAggregate, \ArrayAccess, \JsonSerializable
{
    /**
     * @var array
     */
    private $elements;

    /**
     * ArrayCollection constructor.
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
    }

    public function isEmpty()
    {
        return count($this->elements) == 0;
    }

    public function first()
    {
        return reset($this->elements);
    }
    public function firstOrNull()
    {
        if ($result = $this->first()) {
            return $result;
        }
        return null;
    }

    /**
     * @param $value
     */
    public function add($value)
    {
        $this->elements[] = $value;
    }

    /**
     * Clear the internal array
     */
    public function clear()
    {
        $this->elements = [];
    }

    /**
     * Checks if collection contains provided element.
     *
     * @param $element
     *
     * @return bool
     */
    public function contains($element)
    {
        return in_array($element, $this->elements, true);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->elements);
    }

    public function offsetExists($offset)
    {
        return $this->containsKey($offset);
    }

    /**
     * Checks if collection contains provided key.
     *
     * @param $key
     *
     * @return bool
     */
    public function containsKey($key)
    {
        return isset($this->elements[$key]) || array_key_exists($key, $this->elements);
    }

    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        if (isset($this->elements[$key])) {
            return $this->elements[$key];
        }

        return null;
    }

    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    /**
     * @param $key
     * @param $element
     */
    public function set($key, $element)
    {
        $this->elements[$key] = $element;
    }

    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    public function remove($key)
    {
        if (isset($this->elements[$key]) || array_key_exists($key, $this->elements)) {
            $removed = $this->elements[$key];
            unset($this->elements[$key]);

            return $removed;
        }

        return null;
    }

    public function count()
    {
        return count($this->elements);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->elements;
    }

    /**
     * {@inheritdoc}
     */
    public function filter(Closure $p)
    {
        return new static(array_filter($this->elements, $p));
    }

    protected function extractProperties($propertyFetchMethod)
    {
        $values = [];
        $this->forAll(
            function ($entry) use (&$values, $propertyFetchMethod) {
                $values[] = $entry->{$propertyFetchMethod}();
            }
        );

        return $values;
    }

    /**
     * @param callable|Closure $p
     */
    public function forAll(Closure $p)
    {
        foreach ($this->elements as $key => $element) {
            $p($element, $key);
        }
    }
}