# Example Mapper Definition

	namespace App\Mapper;

	use Gacela\Mapper\Mapper as M;

	class User extends M
	{
		// Relies on default initializations
	}

# Example Model Definition

	namespace App\Model;

	// In this case there is a Model class in the App namespace which extends Gacela\Model\Model
	class User extends Model
	{
		protected function _get_custom_prop()
		{
			return 'I am a custom property';
		}

		protected function _set_prop($val)
		{
			$this->prop = trim($val);
		}
	}

# Find a single model by its identity

	// $user is an instance of App\Model\User, returned from App\Mapper\User
	$user = Kacela::find('user', 1);

	$user->first_name = 'John';
	$user->last_name = 'Bob';

	// Changed fields are saved
	$user->save();

# Finding a collection of models with Kacela::find_all()

	$criteria = Kacela::criteria();

	$criteria->equals('is_deleted', false)
			->in('role', array('employee', 'admin'))
			->like('email', '@domain.com');

	// Collection contains all users with a role of employee or admin that have not been deleted and have
	// an email @domain.com
	$users = Kacela::find_all('user', $criteria);

	foreach($users as $user)
	{
		echo $user->custom_prop;
	}

# Using a custom find method to return a collection

In App/Mapper/User:

	public function find_by_business_zip_code($zip_code)
	{
		$query = $this->_source->getQuery()
					->from(array('u' => 'users'))
					->join(array('a' => 'addresses'), 'u.id = a.user_id')
					->where('a.zip_code_id', $zip_code);

		$result = $this->_source->query($query);

		return new Gacela\Collection($this, $result);
	}

In the Controller:

	$users = Kacela::load('user')->find_by_business_zip_code(84095);

	foreach($users as $user)
	{
		echo $user->city;
	}
