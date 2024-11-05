import { useState, useEffect } from 'react'
import { getAllByStatus, JobStatus } from '../services/job';
import { Job } from '../services/job';
import JobCard from '../components/Job/JobCard';

function Jobs() {
    const [jobs, setJobs] = useState([]);

    const fetchJobs = async () => {
        try {
            const jobs = await getAllByStatus(JobStatus.PENDING);
            setJobs(jobs['member'] || []);
        } catch (error) {
            // TODO: Improve error process
            console.error(error);
        }
    }

    useEffect(() => {
        fetchJobs();
    }, []);

    return (
        <>
            <section id="jobs">
                <h2>Available Jobs</h2>
                {jobs.length > 0
                    ?
                    jobs.map((job: Job) => (
                        <JobCard key={job.id} job={job} />
                    ))
                    :
                    <p>No jobs available.</p>
                }
            </section>
        </>
    )
}

export default Jobs;