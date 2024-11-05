import { useState, useEffect } from 'react';
import { useParams } from "react-router-dom";
import { getOneById, Job } from "../../services/job";
import OfferForm from '../Offer/OfferForm';
import OfferCard from '../Offer/OfferCard';
import './jobDetails.css';

function JobDetail() {
    const { id } = useParams();
    const [job, setJob] = useState<Job | null>(null);

    const fetchJob = async () => {
        try {
            const job = await getOneById(Number(id));
            setJob(job);
        } catch (error) {
            // TODO: Improve error process
            console.error(error);
        }
    };

    useEffect(() => {
        fetchJob();
    }, [id]);

    return (
        <>
            <article id="job-details">
                {job ? (
                    <>
                        <h2>{job.title}</h2>
                        <p className="job-description">{job.description}</p>
                        <p className="job-customer"><small>Posted by: {job.customer.name}</small></p>
                        
                        <h3>Offers</h3>
                        {job.offers && job.offers.length > 0 ? (
                            <ul className="offer-list">
                                {job.offers.map((offer) => (
                                    <OfferCard key={offer.id} offer={offer} />
                                ))}
                            </ul>
                        ) : (
                            <p>No offers available for this job.</p>
                        )}

                        <OfferForm jobId={job.id} setJob={setJob}/>
                    </>
                ) : (
                    <p>Loading job details...</p>
                )}
            </article>
        </>
    );
}

export default JobDetail;
