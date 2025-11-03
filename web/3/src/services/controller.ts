import { EmitAction } from './../types';

export const initController = (root: Element, emit: EmitAction) => {
    if ('ontouchstart' in window || navigator.maxTouchPoints > 0) {
        initOnMobile(root, emit);
    } else {
        initOnDesktop(root, emit);
    }
};

const initOnMobile = (element: Element, emit: EmitAction) => {
    let startX = 0, startY = 0, endX = 0, endY = 0;

    element.addEventListener('touchstart', (e: Event) => {
        startX = (e as TouchEvent).touches[0].clientX;
        startY = (e as TouchEvent).touches[0].clientY;
    });

    element.addEventListener('touchend', (e: Event) => {
        endX = (e as TouchEvent).changedTouches[0].clientX;
        endY = (e as TouchEvent).changedTouches[0].clientY;

        const diffX = endX - startX;
        const diffY = endY - startY;

        if (Math.abs(diffX) > Math.abs(diffY)) {
            emit(diffX > 0 ? 'right' : 'left');
        } else {
            emit(diffY > 0 ? 'down' : 'up');
        }
    });
};

const initOnDesktop = (_element: Element, emit: EmitAction) => {
    window.addEventListener('keydown', (e: KeyboardEvent) => {
        switch (e.key) {
            case 'ArrowUp':
                emit('up');
                break;
            case 'ArrowDown':
                emit('down');
                break;
            case 'ArrowLeft':
                emit('left');
                break;
            case 'ArrowRight':
                emit('right');
                break;
        }
    });
};