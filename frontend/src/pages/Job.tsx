import { useState, useEffect } from 'react'
import { useParams } from "react-router-dom";
import { getOneById } from "../services/job";
import JobDetails from '../components/Job/JobDetails';

function Job() {
    const {id} = useParams();
    const [job, setJob] = useState();

    const fetchJob = async () => {
        try {
            const job = await getOneById(Number(id));
            setJob(job);
        } catch (error) {
            // TODO: Improve error process
            console.error(error);
        }
    }

    useEffect(() => {
        fetchJob();
    }, []);

    return (
        <>
            <section>
                {job ? (
                    <>
                        <JobDetails />
                    </>
                ) : (
                    <p>Loading job details...</p> // Message de chargement pendant la récupération des données
                )}
            </section>
        </>
    )
}

export default Job;