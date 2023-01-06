import Header from '../component/header.js';
import Footer from '../component/footer.js';
import React, { useEffect, useState } from 'react'
import axios from "axios";
import { useParams } from 'react-router-dom'

const sendArticles = async (e) => {
   try {
      const options = {
         url: 'http://localhost:8000/api/category',
         method: 'GET',
         headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json;charset=UTF-8'
         },
      }
      const response = await axios(options);
   }
   catch (error) {
   console.log(error);
   }
}

const AddArticle = () => {

   return(
      <div>
         <Header />
            <div className='add_article'>
               <form onSubmit={(e) => sendArticles(e)}>
                  {/* <input onChange={}></input>
                  <input onChange={}></input> */}
                  <select value={category}>
                        
                  </select>
               </form>
            </div>
         <Footer />
      </div>
   );
}

export default AddArticle;