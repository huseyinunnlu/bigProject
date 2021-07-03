import UsersList from './components/users/list';
import AnimalsList from './components/animals/list';
import AnimalsEdit from './components/animals/edit';
import RationsList from './components/admin-rations/list';
import RationFood from './components/admin-rations/rationfood';
import RationType from './components/admin-rations/rationtype';

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
	},
	{
		path: '/adminpanel/rations',
		name: 'RationsList',
		component: RationsList
	},
	{
		path: '/adminpanel/rationfood/:id',
		name: 'RationFood',
		component: RationFood
	},
	{
		path: '/adminpanel/rationtype/:id',
		name: 'RationType',
		component: RationType
	},
	
];