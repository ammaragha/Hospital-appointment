import { ISpecial } from "./ispecial";
import { IUser } from "./iuser";

export interface Ireserve {
    id?: number,
    special_id?: ISpecial,
    time?: string,
    date?: string,
    user?:IUser
}
