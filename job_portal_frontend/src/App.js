import jobsList from './components/jobs';
import { useState, useEffect } from 'react';
import Createjobs from './components/createjob';
import {BrowserRouter as Router, Route, Switch} from 'react-router-dom';

function App() {

  const getjobs=()=>{
    fetch("http://localhost:8000/api/job").then((response)=>{
      response.json().then((result)=>{
        setJoblist(result);
      })
    })
  }
  const [Joblist, setJoblist] = useState([]);
  const deleteuser = (id)=>{

    fetch('http://localhost:8000/api/jobDelete/'+id,
        {
            method: "DELETE",
        }).then((result)=>{
            result.json().then((resp)=>{
                alert("Job Deleted")
                getjobs()
            })
        })
  }

  const addNewJob=(newJob)=>{
    fetch('http://localhost:8000/api/job', {
                          method: "Post",
                          headers:{
                              'Content-Type':'application/json'
                          },
                          body: JSON.stringify(newJob)
                      }).then((result)=>{
                          result.json().then((resp)=>{
                              alert("Job has heen added")
                              getjobs()
                          })
                      })
  }
  const updateJob=(id,editJob)=>{
    fetch('http://localhost:8000/api/jobUpdate/'+id, {
            method: "Post",
            headers:{
                'Content-Type':'application/json'
            },
            body: JSON.stringify(editJob)
        }).then((result)=>{
            result.json().then((resp)=>{
                alert("Job has heen edited")
                getjobs()
            })
        });

        

    
  }
  
  useEffect(() => {
    fetch("http://localhost:8000/api/job").then((response)=>{
      response.json().then((result)=>{
        setJoblist(result);
      })
    })
  },[]);


  
  return (
   
    <Router>
      <Switch>
          <Route exact path='/'> 
              <h1>Job</h1>
          </Route>
          <Route path='/job/list'>
            <div>
                <jobsList list={Joblist} deleteCallback={deleteuser}/>
            </div>
          </Route>
          <Route path='/job/create'>
              <Createjobs status='add' addjobCallback={addNewJob} />
          </Route>
          <Route path='/job/edit/:id' children={<Createjobs status='edit' updatejobCallback={updateJob} />} ></Route>
          <Route path='*'>
              404 not found
          </Route>          
      </Switch>
  </Router>
  );
}

export default App;
