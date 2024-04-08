<?php

namespace SME\Laravel\Model;

use Illuminate\Database\Eloquent\Builder as LaravelDatabaseBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Model;
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
	 * Current Model
	 *
	 * @var Model
	 */
	private $currentModel;
	
	/**
	 * Model Class Name
	 *
	 * @var string
	 */
	private $modelClass;
	
	public function __construct(QueryBuilder $query, Dispatcher $dispatcher, Model $model) {
		parent::__construct($query);
		static::setEventDispatcher($dispatcher);
		
		$this->currentModel = $model;
		$this->modelClass = get_class($model);
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
            "eloquent.{$event}: ".$this->modelClass, $this->currentModel
        );
    }

	/**
     * Delete records from the database.
     *
     * @return mixed
     */
	public function delete() {
		$this->emitModelEvent('deleting', false);

		$delete = parent::delete();
		
		if ($delete > 0) $this->emitModelEvent('deleted', false);
		
		return $delete;
	}

	/**
     * Update records in the database.
     *
     * @param  array  $values
     * @return int
     */
	public function update(array $values) {
		$this->emitModelEvent('updating', false);
		
		$update = parent::update($values);

		if ($update > 0) $this->emitModelEvent('updated', false);
		
		return $update;
	}
	
}