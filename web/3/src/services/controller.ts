import { EmitAction } from './../types';

export const initController = (root: Element, emit: EmitAction): () => void => {
    if ('ontouchstart' in window || navigator.maxTouchPoints > 0) {
        return initOnMobile(root, emit);
    } else {
        return initOnDesktop(root, emit);
    }
};

const initOnMobile = (element: Element, emit: EmitAction): () => void => {
    let startX = 0, startY = 0, endX = 0, endY = 0;

    const touchStartHandler = (e: Event) => {
        startX = (e as TouchEvent).touches[0].clientX;
        startY = (e as TouchEvent).touches[0].clientY;
    };

    const touchEndHandler = (e: Event) => {
        endX = (e as TouchEvent).changedTouches[0].clientX;
        endY = (e as TouchEvent).changedTouches[0].clientY;

        const diffX = endX - startX;
        const diffY = endY - startY;

        if (Math.abs(diffX) > Math.abs(diffY)) {
            emit(diffX > 0 ? 'right' : 'left');
        } else {
            emit(diffY > 0 ? 'down' : 'up');
        }
    };

    element.addEventListener('touchstart', touchStartHandler);
    element.addEventListener('touchend', touchEndHandler);

    return () => {
        element.removeEventListener('touchstart', touchStartHandler);
        element.removeEventListener('touchend', touchEndHandler);
    };
};

const initOnDesktop = (_element: Element, emit: EmitAction): () => void => {
    const keydownHandler = (e: KeyboardEvent) => {
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
    };

    window.addEventListener('keydown', keydownHandler);

    return () => {
        window.removeEventListener('keydown', keydownHandler);
    };
};