import React from "react";
import { Link } from "react-router-dom";

const job = ({id,name,title,location,salary, callback})=>{
    return (
        <div className= 'std'>
            <h3>Name: {name}</h3>
            <p>title: {title}</p>
            <p>location: {location}</p>
            <p>salary: {salary}</p>
            <button onClick={()=>callback(id)}>Delete</button>
            <Link to={`/job/edit/${id}`}> EDIT</Link>
        </div>
    );
}

export default job;