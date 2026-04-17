"use client";

import { motion } from "framer-motion";

const services = [
  "Billboard Advertising",
  "•",
  "Creative Production",
  "•",
  "Brand Films",
  "•",
  "Media Planning",
  "•",
  "Transit Media",
  "•",
  "Photography",
  "•",
  "Digital OOH",
  "•",
];

export default function Marquee() {
  return (
    <div className="bg-brand-gold py-6 overflow-hidden select-none border-y border-brand-gold/20 flex">
      <motion.div
        animate={{ x: ["0%", "-50%"] }}
        transition={{
          repeat: Infinity,
          ease: "linear",
          duration: 30,
        }}
        className="flex whitespace-nowrap items-center min-w-max"
      >
        {/* Double the content for seamless looping */}
        {[...Array(4)].map((_, i) => (
          <div key={i} className="flex space-x-12 items-center mx-6">
            {services.map((service, index) => (
              <span
                key={index}
                className={
                  service === "•"
                    ? "text-brand-bg/40 text-xl font-black"
                    : "text-brand-bg text-xl font-black uppercase tracking-tighter"
                }
              >
                {service}
              </span>
            ))}
          </div>
        ))}
      </motion.div>
    </div>
  );
}
