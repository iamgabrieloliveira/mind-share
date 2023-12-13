import { store } from './store.ts';

const showLoadingWhile = (pending: Promise<any>) => {
  store.isLoadingActive = true;
  pending
    .finally(() => store.isLoadingActive = false);
}

export { showLoadingWhile };