<script>
export default {
    name: 'Modal',
    props: {
        header: {
            type: String,
            required: true,
        },
    },
    methods: {
        close() {
            this.$emit('close');
        },
    },
};
</script>

<template>
    <transition name="modal-fade">
        <div class="modal-backdrop">
            <div
                class="modal w-3/4 relative transform overflow-hidden rounded-lg bg-white text-left shadow-2xl transition-all sm:my-8"
                role="dialog"
                aria-labelledby="modalTitle"
                aria-describedby="modalDescription"
            >
                <header class="modal-header" id="modalTitle">
                    <slot name="header">
                        <h1 class="flex justify-center text-4xl text-lime-600">
                            {{ header }}
                        </h1>
                    </slot>
                    <button type="button" class="btn-close !text-gray-500" @click="close" aria-label="Close modal">
                        X
                    </button>
                </header>

                <section class="modal-body" id="modalDescription">
                    <slot name="body">

                    </slot>
                </section>

                <footer class="modal-footer">
                    <slot name="footer">

                    </slot>

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
}

.modal {
    background: #FFFFFF;
    box-shadow: 2px 2px 20px 1px;
    overflow-x: auto;
    display: flex;
    flex-direction: column;
}

.modal-header,
.modal-footer {
    padding: 15px;
    display: flex;
}

.modal-header {
    position: relative;
    border-bottom: 1px solid #eeeeee;
    color: #4AAE9B;
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
    color: #4AAE9B;
    background: transparent;
}

.btn-green {
    color: white;
    background: #4AAE9B;
    border: 1px solid #4AAE9B;
    border-radius: 2px;
}

.modal-fade-enter,
.modal-fade-leave-to {
    opacity: 0;
}

.modal-fade-enter-active,
.modal-fade-leave-active {
    transition: opacity .5s ease;
}
</style>
