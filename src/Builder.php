<?php

namespace SME\Laravel\ModelEvents;

use Illuminate\Database\Eloquent\Builder as LaravelDatabaseBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Events\Dispatcher;

class Builder extends LaravelDatabaseBuilder {
	
	use HasEvents;

	/**
	 * Dispatcher
	 *
	 * @var Dispatcher
	 */
	protected static $dispatcher;
	
	/**
	 * Model Name
	 *
	 * @var string
	 */
	private string $modelName;
	
	public function __construct(QueryBuilder $query, Dispatcher $dispatcher, string $modelName) {
		parent::__construct($query);
		static::setEventDispatcher($dispatcher);
		$this->modelName = $modelName;
	}

	/**
     * Fire the given event for the model.
     *
     * @param  string  $event
     * @param  bool  $halt
     * @return mixed
     */
    private function emitModelEvent($event, $halt = true)
    {
        if (! isset(static::$dispatcher)) {
            return true;
        }

        // First, we will get the proper method to call on the event dispatcher, and then we
        // will attempt to fire a custom, object based event for the given event. If that
        // returns a result we can return that result, or we'll call the string events.
        $method = $halt ? 'until' : 'dispatch';

        return ! empty($result) ? $result : static::$dispatcher->{$method}(
            "eloquent.{$event}: ".$this->modelName, $this
        );
    }

	/**
     * Delete records from the database.
     *
     * @return mixed
     */
	public function delete() {
		$this->emitModelEvent('deleting');

		$delete = parent::delete();

		$this->emitModelEvent('deleted');
		
		return $delete;
	}

	/**
     * Update records in the database.
     *
     * @param  array  $values
     * @return int
     */
	public function update(array $values) {
		$this->emitModelEvent('updating');
		
		$update = parent::update($values);

		$this->emitModelEvent('updated');
		
		return $update;
	}
	
}