import { useNavigate } from 'react-router-dom';
import './jobCard.css'; 

interface JobInterface {
    job : {
        id: number,
        title: string,
        description: string,
        customer: {
            name: string
        }
    }
}

function JobCard({ job }: JobInterface) {
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
