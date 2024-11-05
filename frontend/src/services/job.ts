import { Offer } from "./offer";

export interface Job {
    id: number,
    title: string,
    description: string,
    customer: {
        name: string
    }
    offers: Offer[];
}

enum JobStatus {
    PENDING = 1,
    IN_PROGRESS = 2,
    DONE = 3
}

const getAllByStatus = async (status: number) => {
    const endpoint = status ? `/api/jobs?status=${status}` : '/api/jobs';
    const response = await fetch(`http://localhost:8000${endpoint}`);

    if (response.ok) return await response.json();
    else throw new Error('API unavailable.');
}

const getOneById = async (id: number) => {
    const endpoint = `/api/jobs/${id}`;
    const response = await fetch(`http://localhost:8000${endpoint}`);

    if (response.ok) return await response.json();
    else throw new Error('API unavailable.');
}

export { getAllByStatus, getOneById, JobStatus };