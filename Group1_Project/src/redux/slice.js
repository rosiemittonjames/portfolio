import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  watering: null,
  sunlight: null,
  difficulty: null,
  petSafe: null, //boolean
  heightCategory: null,
  plantsForSwipe: [],
  plantsForGallery: [],
};

export const plantSlice = createSlice({
  name: "plants",
  initialState,
  reducers: {
    setWatering: (state, action) => {
      state.watering = action.payload;
    },
    setSunlight: (state, action) => {
      state.sunlight = action.payload;
    },
    setDifficulty: (state, action) => {
      state.difficulty = action.payload;
    },
    setPetSafe: (state, action) => {
      state.petSafe = action.payload;
    },
    setHeightCategory: (state, action) => {
      state.heightCategory = action.payload;
    },
    setPlantsForSwipe: (state, action) => {
      state.plantsForSwipe = action.payload;
    },
    setPlantsForGallery: (state, action) => {
      state.plantsForGallery = action.payload;
    },
    resetState: () => initialState,
  },
});

export const {
  setWatering,
  setSunlight,
  setDifficulty,
  setPetSafe,
  setHeightCategory,
  setPlantsForSwipe,
  setPlantsForGallery,
  resetState,
} = plantSlice.actions;

export default plantSlice.reducer;
