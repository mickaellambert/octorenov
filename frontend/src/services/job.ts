export interface Job {
    id: number,
    title: string,
    description: string,
    customer: {
        name: string
    }
    offers: Offer[];
}
const getAllByStatus = async (status: number) => {
    const endpoint = status ? `/api/jobs?status=${status}` : '/api/jobs';
    const response = await fetch(`http://localhost:8000${endpoint}`);

    if (response.ok) return await response.json();
    else throw new Error('API unavailable.');
}
