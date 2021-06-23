import UsersList from './components/users/list';
import AnimalsList from './components/animals/list';

export const routes = [
	{
		path: '/users',
		name: 'UsersList',
		component: UsersList,
	},
	{
		path: '/animals',
		name: 'AnimalsList',
		component: AnimalsList,
	},
];