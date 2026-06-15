export class BootstrapComponents {
    /**
     * Creates and configures a customizable modal component.
     *
     * @param {Object} [options={}] - Configuration options for the modal.
     * @param {string} [options.title="Modal Title."] - The text displayed in the modal header.
     * @param {string} [options.body="Modal content body text goes here."] - The main content text or HTML inside the modal.
     * @param {boolean} [options.haveConfirm=true] - Determines whether the confirmation button is visible.
     * @param {string} [options.confirmText="Confirm"] - The text label for the confirmation button.
     * @param {string} [options.dismissText="Dismiss"] - The text label for the cancellation or close button.
     * @param {string} [options.confirmColor='primary'] - The style or color theme class for the confirmation button.
     * @param {Function} [options.onConfirm=(() => {})] - Callback function executed when the confirmation button is clicked.
     * @returns {void}
     */
    static createModal(options = {}) {
        const config = {
            title: options.title ?? "Modal Title.",
            body: options.body ?? "Modal content body text goes here.",
            haveConfirm: options.haveConfirm ?? true,
            confirmText: options.confirmText ?? "Confirm",
            dismissText: options.dismissText ?? "Dismiss",
            confirmColor: options.confirmColor ?? "primary",
            onConfirm: options.onConfirm ?? (() => {}),
        };

        const modalId = `js-modal-${Date.now()}`;
        let confirmed = false;

        const modalHtml =
        `
        <div class="modal fade" id="${modalId}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">${config.title}</h1>
                    </div>
                    <div class="modal-body">
                        ${config.body}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">${config.dismissText}</button>` +
                (config.haveConfirm
                    ? `<button id="${modalId}-confirm" type="button" class="btn btn-${config.confirmColor}" data-bs-dismiss="modal">${config.confirmText}</button>`
                    : "") +
                `</div>
                </div>
            </div>
        </div>
        `;

        document.body.insertAdjacentHTML("beforeend", modalHtml);

        const modalElem = document.getElementById(modalId);
        if (config.haveConfirm) {
            const confirmBtn = document.getElementById(`${modalId}-confirm`);
            confirmBtn.addEventListener("click", () => {
                confirmed = true;
            });
        }
        const bsModal = new bootstrap.Modal(modalElem);

        // Wait until modal is gone to be deleted
        modalElem.addEventListener("hidden.bs.modal", () => {
            modalElem.remove();

            if (confirmed) config.onConfirm(bsModal);
        });

        bsModal.show();
    }
}