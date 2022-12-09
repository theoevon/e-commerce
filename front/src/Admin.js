import { Admin, Resource } from "react-admin";
import jsonServerProvider from "ra-data-json-server";
import { UserList } from "./users.js";
import { PostList, PostEdit, PostCreate } from "./posts.js";

const dataProvider = jsonServerProvider('http://localhost:8000');

const User = () => ( 
<Admin basename="/admin" dataProvider={dataProvider}>
<Resource name="users" list={UserList} recordRepresentation="name" />
<Resource name="showArticle" list={PostList} edit={PostEdit} create={PostCreate}  />
 </Admin>
);

export default User;