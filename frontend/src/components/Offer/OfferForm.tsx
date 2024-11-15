import { useState } from 'react';
import { createOffer } from '../../services/offer';
import './offerForm.css';

interface OfferFormProps {
    jobId: number;
    setJob: any;
}

function OfferForm({ jobId, setJob }: OfferFormProps) {
    const [amount, setAmount] = useState<string | ''>('');
    const [message, setMessage] = useState<string | null>(null);

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();

        if (amount === '') {
            setMessage("Please enter a valid amount.");
            return;
        }

        try {
            const newOffer = await createOffer({ jobId, amount: amount });
            setJob((prevState: any) => ({...prevState, offers: [...prevState.offers, newOffer]}))
            setMessage("Your offer has been submitted successfully!");
            setAmount('');
        } catch (error: any) {
            if (error.status === 422) {
                setMessage(error.data.violations[0].message);
            } else {
                setMessage("An error occurred while submitting your offer. Please try again.");
            }
        }
    };

    return (
        <form onSubmit={handleSubmit} className="offer-form">
            <label htmlFor="amount">Offer Amount:</label>
            <input
                type="number"
                id="amount"
                value={amount}
                onChange={(e) => setAmount(e.target.value)}
                step="0.01"
                required
            />
            <button type="submit">Submit Offer</button>
            
            {message && <p className="offer-message">{message}</p>}
        </form>
    );
}

export default OfferForm;
