import { Admin, Resource, EditGuesser } from "react-admin";
import jsonServerProvider from "ra-data-json-server";
import { UserList } from "./users.js";
import { PostList, PostEdit, PostCreate } from "./posts.js";

const dataProvider = jsonServerProvider('https://jsonplaceholder.typicode.com');

const User = () => ( 
<Admin basename="/admin" dataProvider={dataProvider}>
<Resource name="users" list={UserList} recordRepresentation="name" />
<Resource name="posts" list={PostList} edit={PostEdit} create={PostCreate}  />
 </Admin>
);

export default User;