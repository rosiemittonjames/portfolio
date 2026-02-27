export function BackButton({ onClick }) {
  return (
    <svg
      onClick={onClick}
      width="80"
      height="80"
      viewBox="0 0 100 100"
      fill="none"
      xmlns="http://www.w3.org/2000/svg"
      className="cursor-pointer"
    >
      <defs>
        <mask id="arrowMask">
          <circle cx="50" cy="50" r="40" fill="white" />
          <path
            d="M60 30 L35 50 L60 70"
            stroke="black"
            strokeWidth="8"
            strokeLinecap="round"
            strokeLinejoin="round"
            fill="none"
          />
        </mask>
      </defs>

      <circle cx="50" cy="50" r="40" fill="#1B5E4F" mask="url(#arrowMask)" />
    </svg>
  );
}
