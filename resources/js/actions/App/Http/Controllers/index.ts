import Auth from './Auth'
import VehicleLookupController from './VehicleLookupController'
import AdminController from './AdminController'
import Settings from './Settings'

const Controllers = {
    Auth: Object.assign(Auth, Auth),
    VehicleLookupController: Object.assign(VehicleLookupController, VehicleLookupController),
    AdminController: Object.assign(AdminController, AdminController),
    Settings: Object.assign(Settings, Settings),
}

export default Controllers