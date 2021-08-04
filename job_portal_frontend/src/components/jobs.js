import React from 'react';
import job from './job';


const jobsList = ({list, deleteCallback})=>{
   
    return (
        <div>
            <h1>JOBS</h1>
            <div>
            {
                list.map((u)=>{
                
                    return <job key={u.id} {...u} callback={deleteCallback}/>
                })
            }
            </div>
        </div>
    );
}

export default jobsList;