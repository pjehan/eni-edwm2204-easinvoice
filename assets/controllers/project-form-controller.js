import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['quotes', 'invoices'];

    connect() {
        super.connect();
        this.quotePrototype = this.quotesTarget.dataset.prototype;
        this.quoteIndex = this.quotesTarget.dataset.index;
        this.invoicePrototype = this.invoicesTarget.dataset.prototype;
        this.invoiceIndex = this.invoicesTarget.dataset.index;
    }

    createCard(cardContent, container) {
        let removeBtn = document.createElement('button');
        removeBtn.classList.add('btn');
        removeBtn.classList.add('btn-danger');
        removeBtn.innerText = 'Delete';

        let cardBody = document.createElement('div');
        cardBody.classList.add('card-body');
        cardBody.innerHTML = cardContent;
        cardBody.appendChild(removeBtn);

        let card = document.createElement('article');
        card.classList.add('card');
        card.appendChild(cardBody);

        let col = document.createElement('div');
        col.classList.add('col-md-6');
        col.appendChild(card);

        removeBtn.addEventListener('click', () => container.removeChild(col));

        container.appendChild(col);
    }

    addQuote() {
        const prototype = this.quotePrototype.replace(/__name__/g, this.quoteIndex);
        this.createCard(prototype, this.quotesTarget)
        this.quoteIndex++;
    }

    removeQuote({ params }) {
        this.quotesTarget.removeChild(this.quotesTarget.querySelector('#quote-' + params.id));
        this.quoteIndex--;
    }

    addInvoice() {
        const prototype = this.invoicePrototype.replace(/__name__/g, this.invoiceIndex);
        this.createCard(prototype, this.invoicesTarget)
        this.invoiceIndex++;
    }

    removeInvoice({ params }) {
        this.invoicesTarget.removeChild(this.invoicesTarget.querySelector('#invoice-' + params.index));
        this.invoiceIndex--;
    }
}
