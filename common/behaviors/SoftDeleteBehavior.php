<?php

namespace common\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;

class SoftDeleteBehavior extends Behavior
{
public $softDeleteAttributeValues;
public $restoreAttributeValues;
public $replaceRegularDelete = true;

public function events()
{
    return [
        ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
    ];
}

public function beforeDelete($event)
{
    if ($this->replaceRegularDelete) {
        $this->owner->delete();
    } else {
        $this->softDelete();
    }

    // Prevent the actual deletion from the database
    $event->isValid = false;
}

public function softDelete()
{
    foreach ($this->softDeleteAttributeValues as $attribute => $value) {
        $this->owner->$attribute = $value;
    }

    $this->owner->save(false);
}

public function restoreSoftDelete()
{
    foreach ($this->restoreAttributeValues as $attribute => $value) {
        $this->owner->$attribute = $value;
    }

    $this->owner->save(false);
}
}
