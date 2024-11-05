import { useNavigate } from 'react-router-dom';
import './jobCard.css'; 
import { Job } from '../../services/job';

interface JobCard {
    job : Job
}

function JobCard({ job }: JobCard) {
    const navigate = useNavigate();

    return (
        <article className="job-card" onClick={() => navigate(`/jobs/${job.id}`)}>
            <h3>{job.title}</h3>
            <p>{job.description}</p>
            <footer>
                <small>Customer: {job.customer.name}</small>
            </footer>
        </article>
    );
}

export default JobCard;
