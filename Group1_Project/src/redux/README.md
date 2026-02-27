# Redux State Management

This document explains how Redux and redux-persist work in this project. Instead of storing data in local component state or passing it through props, we use Redux as a global store. This allows any component, whether it's a different page or UI element—to access and update the shared data. Such as, building up the query params (watering, sunlight, difficulty, petsafe and heightCategory) and call the endpoint after user seleted all answers. And store the plants array from endpoint then swipe page and gallery page could access array.

## Store Structure

```js
state.plants = {
  watering: Minimum, Average, Frequent | null,
  sunlight: shy, ambivert, extrovert | null,
  difficulty: easy, hard | null,
  petSafe: boolean | null,
  heightCategory: short, average, tall | null,
  plantsForSwipe: [],
  plantsForGallery: [],
}
```

## How to update Data in redux (useDispatch)

```jsx
import { useDispatch } from "react-redux";
import { setWatering, setPlantsForGallery, resetState } from "../redux/slice";

function MyComponent() {
  const dispatch = useDispatch();

  //update params in question pages
  dispatch(setWatering("weekly"));

  //update array loading page and swipe page
  dispatch(
    setPlantsForGallery([
      {
        id: 1149,
        scientific_name: "Suruga Benten'",
      },
      {
        id: 1150,
        scientific_name: "Variegata'",
      },
    ]),
  );

  // reset all state to initial values i.e. reset button
  dispatch(resetState());
}
```

## How to access Data (useSelector)

```jsx
import { useSelector } from "react-redux";

function MyComponent() {
  // Read param
  const watering = useSelector((state) => state.plants.watering);

  // Read plants array in swipe page and gallery page
  const plantsForGallery = useSelector(
    (state) => state.plants.plantsForGallery,
  );

  return <div>{watering}</div>;
}
```

## Available Actions

| Action                | Payload           | Description                     |
| --------------------- | ----------------- | ------------------------------- |
| `setWatering`         | `string \| null`  | Set watering preference         |
| `setSunlight`         | `string \| null`  | Set sunlight preference         |
| `setDifficulty`       | `string \| null`  | Set difficulty preference       |
| `setPetSafe`          | `boolean \| null` | Set pet safety preference       |
| `setHeightCategory`   | `string \| null`  | Set height category             |
| `setPlantsForSwipe`   | `Plant[]`         | Set plants for swipe page       |
| `setPlantsForGallery` | `Plant[]`         | Set liked plants for gallery    |
| `resetState`          | none              | Clear all data to initial state |

## Start Again Button and sorrybutton

The `StartAgainButton` component uses `resetState()` to clear all Redux data when clicked:

```jsx
import { useDispatch } from "react-redux";
import { resetState } from "../redux/slice";

dispatch(resetState()); // Clears all data
```

## Debugging with Redux DevTools

To inspect Redux state and actions in the browser, you can go to `devtool`, `application` tab to see `Local storage`, under `persist:root`
