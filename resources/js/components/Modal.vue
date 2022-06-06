<script>
export default {
    name: "Modal",
    methods: {
        close() {
            this.$emit("close");
        },
    },
};
</script>

<template>
    <transition name="fade-modal">
        <div class="modal-backdrop">
            <div
                class="modal"
                role="dialog"
                aria-labelledby="modalTitle"
                aria-describedby="modalDescription"
            >
                <header class="modal-header" id="modalTitle">
                    <slot name="header"> This is the default tile! </slot>
                    <button
                        type="button"
                        class="btn-close"
                        @click="close"
                        aria-label="Close modal"
                    >
                        x
                    </button>
                </header>

                <section class="modal-body" id="modalDescription">
                    <slot name="body"> This is the default body! </slot>
                </section>

                <footer class="modal-footer">
                    <slot name="footer"> </slot>
                    <button
                        type="button"
                        class="bg-indigo-400 text-white h-10 inline-flex items-center justify-center px-4 font-bold border rounded-full focus:outline-none"
                        @click="close"
                        aria-label="Close modal"
                    >
                        Close me!
                    </button>
                </footer>
            </div>
        </div>
    </transition>
</template>

<style>
.modal-backdrop {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 100;
}

.modal {
    background: #ffffff;
    box-shadow: 2px 4px 50px 42px rgba(0, 0, 0, 0.16);
    overflow-x: auto;
    display: flex;
    flex-direction: column;
    min-width: 30%;
}

.modal-header,
.modal-footer {
    padding: 15px;
    display: flex;
}

.modal-header {
    position: relative;
    border-bottom: 1px solid #eeeeee;
    justify-content: space-between;
}

.modal-footer {
    border-top: 1px solid #eeeeee;
    flex-direction: column;
}

.modal-body {
    position: relative;
    padding: 20px 10px;
}

.btn-close {
    position: absolute;
    top: 0;
    right: 0;
    border: none;
    font-size: 20px;
    padding: 10px;
    cursor: pointer;
    font-weight: bold;
    background: transparent;
}

.fade-modal-enter-active,
.fade-modal-leave-active {
    transition: opacity 0.2s ease;
}

.fade-modal-enter-from,
.fade-modal-leave-to {
    opacity: 0;
}
</style>
