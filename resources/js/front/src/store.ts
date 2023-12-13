import { reactive } from 'vue';

type TStore  = {
  isLoadingActive: boolean,
  user?: { id: string, name: string },
}

const store = reactive<TStore>({
  isLoadingActive: false,
  user: undefined,
});

export { store };
