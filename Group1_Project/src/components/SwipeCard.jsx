export function SwipeCard({ plant, className = "" }) {
  return (
    plant && (
      <div className={`swipeCard ${className}`}>
        <img
          src={plant.image_url}
          alt={plant.scientific_name}
          key={plant.id}
          //disable the drag in img tag so the chrome do not pan the image as it doenst look smooth
          draggable={false}
        />
      </div>
    )
  );
}
