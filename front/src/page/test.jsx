import { useState } from 'react';
import Child from './Child';


function Test() {
  const [data, setData] = useState('');
  
  const childToParent = (childdata) => {
    setData(childdata);
  }

  return (
    <div className="App">
     {data}
      <div>
        <Child childToParent={childToParent}/>
      </div>
    </div>
  );
}


export default Test


