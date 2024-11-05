const JOBBER_ONLINE = '/api/jobbers/1'; // Simulate authentification with this jobber

export interface Offer {
    id: number;
    amount: number;
    jobber: {
        name: string;
    };
}

export const createOffer = async ({ jobId, amount }: { jobId: number; amount: number }) => {
    const response = await fetch(`http://localhost:8000/api/offers`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/ld+json',
        },
        body: JSON.stringify({ job: `/api/jobs/${jobId}`, amount, jobber: JOBBER_ONLINE}),
    });

    if (response.ok) return await response.json();
    else throw new Error('API unavailable.');
};