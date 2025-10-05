import Auth from './Auth'
import VehicleLookupController from './VehicleLookupController'
import Settings from './Settings'

const Controllers = {
    Auth: Object.assign(Auth, Auth),
    VehicleLookupController: Object.assign(VehicleLookupController, VehicleLookupController),
    Settings: Object.assign(Settings, Settings),
}

export default Controllers