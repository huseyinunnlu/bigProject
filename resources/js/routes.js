import UsersList from './components/users/list';
import AnimalsList from './components/animals/list';
import AnimalsEdit from './components/animals/edit';
import RationsList from './components/admin-rations/list';
import RationFood from './components/admin-rations/rationfood';
import RationType from './components/admin-rations/rationtype';
import FrontRationsList from './components/rations/list';
import FrontRationsCreate from './components/rations/create';
import FrontRationsDetails from './components/rations/details';
import FrontRationsEdit from './components/rations/edit';

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
	{
		path: '/rations',
		name: 'FrontRationsList',
		component: FrontRationsList
	},
	{
		path: '/rations/create',
		name: 'FrontRationsCreate',
		component: FrontRationsCreate
	},
	{
		path: '/rations/:id/details',
		name: 'FrontRationsDetails',
		component: FrontRationsDetails
	},
	{
		path: '/rations/:id/edit',
		name: 'FrontRationsEdit',
		component: FrontRationsEdit
	},
	
];