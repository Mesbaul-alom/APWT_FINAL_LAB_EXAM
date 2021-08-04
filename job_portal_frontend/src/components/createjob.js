import { useParams  } from "react-router";
import React, { useState, useEffect } from 'react';
import { useHistory } from "react-router-dom";


const Createjobs = ({status, addjobCallback, updatejobCallback})=>{
    let history = useHistory();
    const {id:jobId} = useParams();
    const initialState = {name: '',title:'', location: '',salary:'' };
    const [job, setjob] = useState(initialState);
  
    const handleInputChange = (e) => {
      const { name, value } = e.target;
  
      setjob({ ...job, [name]: value });
    };
    const onSubmit = (e) => {
        e.preventdefault();
        status==='add'?addjobCallback(job):updatejobCallback(jobId,job);
                    history.push("/job/list");
    }

    useEffect(() => {
      fetch('http://localhost:8000/api/jobs/'+jobId).then((response) => {
        response.json().then((result) => {
            console.warn(result)
            setjob({ 
                name: result.name,
                title:result.title,
                location:result.location,
                salary:result.salary,
                 

              })
        })
    })
    },[jobId]);
    return(
        <>
            <br/>
            <h4>{status==='add'?'Create':'Edit'} Job : {jobId}</h4>
            <form onSubmit={onSubmit}>
                <label >Name</label>
                <input type='text' name='name' value={job.name} onChange={handleInputChange} /> <br />
                <label >Title</label>
                <input type='text' name='name' value={job.title} onChange={handleInputChange} /> <br />
                <label >Location</label>
                <input type='text' name='location' value={job.location} onChange={handleInputChange} /> <br />
                <label >Salary</label>
                <input type='text' name='salary' value={job.salary} onChange={handleInputChange} /> <br />
                
                
                <input type='submit' value={status==='add'?'Create':'Update'}/>
            </form>
        </>
    );
}

export default Createjobs;