const JOBBER_ONLINE = '/api/jobbers/1'; // Simulate authentification with this jobber

export interface Offer {
    id: number;
    amount: string;
    jobber: {
        name: string;
    };
}

export const createOffer = async ({ jobId, amount }: { jobId: number; amount: string }) => {
    const response = await fetch(`http://localhost:8000/api/offers`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/ld+json',
        },
        body: JSON.stringify({ job: `/api/jobs/${jobId}`, amount, jobber: JOBBER_ONLINE}),
    });

    const responseData = await response.json();
    
    if (!response.ok) {
        throw { status: response.status, data: responseData };
    }
    
    return responseData;
};