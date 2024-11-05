import { Offer } from "../../services/offer";
import './offerCard.css'

interface OfferCard {
    offer: Offer
}

function OfferCard({offer}: OfferCard) {
    return (
        <>
            <li key={offer.id} className="offer-item">
                <p><strong>Amount:</strong> ${offer.amount}</p>
                <p><strong>Jobber:</strong> {offer.jobber.name}</p>
                <div className="offer-actions">
                    <button className="accept-button">Accept</button>
                    <button className="reject-button">Reject</button>
                </div>
            </li>
        </>
    )
}

export default OfferCard;