import { Admin, Resource } from "react-admin";

import jsonServerProvider from "ra-data-json-server";

import { UserList } from "./users.js";

import { PostList, PostEdit, PostCreate } from "./posts.js";

import { HydraAdmin, ResourceGuesser } from "@api-platform/admin";



const User = () => (

<HydraAdmin basename="/admin" entrypoint="http://localhost:8000/api">

 </HydraAdmin>

);

export default User;