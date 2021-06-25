import UsersList from './components/users/list';
import AnimalsList from './components/animals/list';
import AnimalsEdit from './components/animals/edit';

export const routes = [
	{
		path: '/users',
		name: 'UsersList',
		component: UsersList
	},
	{
		path: '/animals',
		name: 'AnimalsList',
		component: AnimalsList
	},
	{
		path: '/animals/:id',
		name: 'AnimalsEdit',
		component: AnimalsEdit
	}
	
];