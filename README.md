## This library allows you to extend the work of life cycle methods

### For example:

```php
class Posts extends Model
{
	public static function booted() {

		self::deleted(function (self $model) {

			//  listening to the deletion event in the current model
			...

		});

	}

```

#### For this code, the listener will not work because the delete method is not in the Model class

```php
public static function deletePost(int $post_id) {
	return self::where('id', $post_id)->delete();
}
```

#### you can use the find($post_id) method then everything will work, but it is not always convenient

```php
public static function deletePost(int $post_id) {
	return self::find($post_id)->delete();
}
```

#### To use the delete or update methods without additional first, find, etc. methods. You can use trait "HasEvents" in your models class

```php
use SME\Laravel\ModelEvents\HasEvents;

class Posts extends Model
{
	use HasEvents;
	
	...

```